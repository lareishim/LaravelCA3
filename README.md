
# 🏀 NBA Hub — Laravel 10 App

**NBA Hub** is a role-based Laravel web app that connects basketball fans with their favorite NBA players — and the Afrobeats tracks they vibe to.

## 🚀 Features

- User authentication (fan, editor, admin)
- Google login for fans
- Dashboard based on user role
- Admin-only CRUD for NBA players
- Player profiles with:
  - YouTube highlight links
  - Afrobeats track embeds
- Tailwind CSS dark theme
- Clean UI with full mobile responsiveness

## 📁 Folder Structure Highlights

- `app/Http/Controllers/PlayerController.php` — Player CRUD logic
- `resources/views/players/` — Player Blade templates
- `routes/web.php` — Route definitions with role middleware
- `app/Http/Middleware/RoleMiddleware.php` — Role-based access control

## 🧑‍💻 User Roles

| Role    | Permissions                                  |
|---------|----------------------------------------------|
| Fan     | View players and Afrobeats music             |
| Editor  | (Optional) Can be extended for moderation     |
| Admin   | Full player management: create, edit, delete |

## 🧱 Tech Stack

- Laravel 10
- Tailwind CSS via Vite
- MySQL / SQLite (your choice)
- Google OAuth 2.0
- Blade components (`x-input-label`, `x-text-input`, etc.)

## 🛠️ Installation

```bash
git clone https://github.com/your-username/nba-hub.git
cd nba-hub

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate

# Run Vite in a separate terminal
npm install && npm run dev
```

## 🔑 Google OAuth Setup

Add your credentials to `.env`:

```env
GOOGLE_CLIENT_ID=your-id
GOOGLE_CLIENT_SECRET=your-secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

## 🧪 Testing Login Roles

- Register with:
  - `name@admin.com` → gets admin role
  - `name@editor.com` → gets editor role
  - any other → fan
- Use login form or Google login (fans only)

## 👥 Contributions

Pull requests welcome! Fork the repo and improve the NBA music + basketball experience.

---

## 📸 Screenshot

> _(Include a screenshot of your dashboard or player page here)_

---

## 📄 License

MIT © YLare Adekeye and David Ailemen
