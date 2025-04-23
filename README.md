# 🗑️ Laravel 10 Soft Delete

This project demonstrates how to implement **Soft Delete** functionality in Laravel using Eloquent’s built-in `SoftDeletes` trait. Instead of permanently deleting records from the database, soft deletes allow you to mark data as "trashed" and optionally restore it later.

---

## ❓ Why Use Soft Delete?

Soft delete is useful when:

- You want to preserve data for auditing or recovery.
- Users accidentally delete something and need a way to restore it.
- You want to show both "active" and "deleted" data in separate views.

Instead of permanently removing a record from the database, soft delete sets a timestamp in the `deleted_at` field.

---

## 🧩 What This Project Contains

- ✅ Soft delete functionality for users
- 🧾 Trashed users list with options to:
  - Restore
  - Permanently delete (force delete)
- 📋 Blade views for users list and trashed users
- 🎛️ Routes and controller logic for all actions

---

## 🛠️ Tech Stack

| Tool             | Purpose                                |
|------------------|-----------------------------------------|
| Laravel 10       | PHP framework                           |
| Blade            | Frontend view engine                    |
| Eloquent ORM     | Database interaction and soft delete    |
| Bootstrap 5      | UI styling for views                    |

---

## 🚀 Important Steps


1️⃣ Enable Soft Deletes in the Migration


In your users table migration file (database/migrations/..._create_users_table.php), add the softDeletes() column:
```bash
$table->softDeletes(); // Adds deleted_at timestamp
Then migrate:

php artisan migrate
```

2️⃣ Use the SoftDeletes Trait in the Model


In app/Models/User.php:
```bash
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
}
```

3️⃣ Soft Delete a Record


In your controller method, use:

```bash
$user = User::findOrFail($id);
$user->delete(); // This sets deleted_at, does not remove the record
```

4️⃣ Query Only Trashed (Soft-Deleted) Records


To get only the soft-deleted users:
```bash
$trashedUsers = User::onlyTrashed()->get();
```

5️⃣ Restore a Soft-Deleted Record


To bring a user back:
```bash
$user = User::onlyTrashed()->findOrFail($id);
$user->restore(); // Clears deleted_at
```

6️⃣ Permanently Delete (Force Delete) a Trashed Record

```bash
$user = User::onlyTrashed()->findOrFail($id);
$user->forceDelete(); // Removes the record from DB
```

7️⃣ Show Only Active (Not Deleted) Records
By default, Laravel ignores soft-deleted records. But just to be explicit:

```bash
$users = User::whereNull('deleted_at')->get();

Or just:
$users = User::all(); // excludes soft-deleted by default
```
