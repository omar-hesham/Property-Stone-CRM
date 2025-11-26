-- PostgreSQL schema with ENUM types and triggers for tsvector maintenance
BEGIN;

-- Create ENUM types
DO $$ BEGIN
    CREATE TYPE project_status AS ENUM ('draft','ongoing','ready','sold_out');
EXCEPTION
    WHEN duplicate_object THEN null;
END $$;

DO $$ BEGIN
    CREATE TYPE unit_status AS ENUM ('available','reserved','sold');
EXCEPTION
    WHEN duplicate_object THEN null;
END $$;

DO $$ BEGIN
    CREATE TYPE user_role AS ENUM ('admin','agent','customer');
EXCEPTION
    WHEN duplicate_object THEN null;
END $$;

DO $$ BEGIN
    CREATE TYPE inquiry_source AS ENUM ('website','phone','walk_in','ad');
EXCEPTION
    WHEN duplicate_object THEN null;
END $$;

DO $$ BEGIN
    CREATE TYPE inquiry_status AS ENUM ('new','contacted','qualified','lost');
EXCEPTION
    WHEN duplicate_object THEN null;
END $$;

-- Tables (simplified excerpts for key parts)
CREATE TABLE projects (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    short_description VARCHAR(512),
    full_description TEXT,
    full_description_tsv tsvector,
    developer_id INTEGER REFERENCES developers(id) ON DELETE SET NULL,
    location_id INTEGER REFERENCES locations(id) ON DELETE SET NULL,
    start_date DATE,
    delivery_date DATE,
    status project_status DEFAULT 'draft',
    cover_media_id BIGINT,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT now(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- Trigger to keep full_description_tsv updated
CREATE FUNCTION projects_tsv_trigger() RETURNS trigger AS $$
begin
  new.full_description_tsv := to_tsvector('english', coalesce(new.full_description,''));
  return new;
end
$$ LANGUAGE plpgsql;

CREATE TRIGGER tsvectorupdate BEFORE INSERT OR UPDATE
ON projects FOR EACH ROW EXECUTE PROCEDURE projects_tsv_trigger();

CREATE INDEX idx_projects_fulltext ON projects USING GIN (full_description_tsv);

-- units using ENUM type
CREATE TABLE units (
    id SERIAL PRIMARY KEY,
    building_id INTEGER REFERENCES buildings(id) ON DELETE CASCADE,
    project_id INTEGER REFERENCES projects(id) ON DELETE SET NULL,
    unit_code VARCHAR(100),
    unit_type VARCHAR(100),
    area_m2 NUMERIC(10,2),
    bedrooms INTEGER,
    bathrooms INTEGER,
    finishing_type VARCHAR(100),
    floor_number INTEGER,
    price NUMERIC(14,2),
    currency VARCHAR(10) DEFAULT 'EGP',
    status unit_status DEFAULT 'available',
    floor_plan_media_id BIGINT,
    created_at TIMESTAMP WITH TIME ZONE DEFAULT now(),
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);

-- inquiries using ENUM types
CREATE TABLE inquiries (
    id SERIAL PRIMARY KEY,
    unit_id INTEGER REFERENCES units(id),
    user_id INTEGER REFERENCES users(id),
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    message TEXT,
    source inquiry_source,
    status inquiry_status DEFAULT 'new',
    created_at TIMESTAMP WITH TIME ZONE DEFAULT now()
);

COMMIT;
