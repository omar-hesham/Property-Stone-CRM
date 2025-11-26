real_estate_v3_artifacts contents and notes

1) Laravel migrations (with SoftDeletes):
   - Copy files from migrations/ to your Laravel project's database/migrations/.
   - Ensure 'media' table migration is placed before any constrained references; filenames are timestamped to enforce order.
   - SoftDeletes were added (->softDeletes()) to keep deleted records for auditing.
   - To use soft deletes in models, add `use SoftDeletes;` in the corresponding Eloquent models.
   - Documentation: https://laravel.com/docs/10.x/eloquent#soft-deleting

2) Seeders & Factories:
   - Copy seeders/ to database/seeders/ and factories/ to database/factories/.
   - Run `php artisan migrate --seed` or `php artisan db:seed` after placing factories and seeders.
   - Factories assume model classes exist with HasFactory trait.
   - Documentation: https://laravel.com/docs/10.x/seeding

3) PostgreSQL enum types & triggers:
   - schema_postgres_enum_triggers.sql creates ENUM types and a trigger to keep full_description_tsv updated.
   - Run in a dev DB and inspect before applying to production.
   - Documentation: https://www.postgresql.org/docs/current/sql-createtype.html

4) Notes:
   - For production, consider using PostgreSQL native ENUMs with caution; they are not as flexible for migrations as CHECK constraints, but offer strict typing.
   - For tsvector maintenance you can also use generated columns (Postgres 12+) or materialized views depending on requirements.

