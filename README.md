# 🏀 Basketball Afrobeats Laravel Project

This is a full-stack Laravel web application that combines the passion of **NBA basketball culture** with the rhythm and influence of **Afrobeats music**. Users can explore NBA players, view their favorite Afrobeats tracks, and interact with a fan-driven platform.

## 👥 Collaborators

- **David Ailemen**
- **Lare Adekeye**

## 🎯 Features

### 🧑‍💼 User Roles
- **Admin**: Full access — manage players, announcements, posts, reports, logs.
- **Editor**: Moderate content, review pending posts.
- **Fan**: Like players, post content, receive announcements.

### 🏀 NBA Player Pages
- Each player is linked to:
  - Profile image and bio
  - Favorite Afrobeats track
  - Embedded YouTube video

### 💬 Announcement System
- Admins can create announcements sent to all users.
- Users have an NBA-style **message inbox** with:
  - Red unread dot
  - Auto-mark as read on click
  - "Clear Messages" button

### 📣 Blog + Commenting
- Authenticated fans can create posts and comment.
- Editors/Admins approve posts before they go live.

### 🔐 Google Login
- OAuth via Google for fast registration and sign-in.

### 🛠️ Activity Logs
- Every important action is tracked with Spatie’s `activitylog`.

## 💡 Tech Stack

- **Backend**: Laravel 10+
- **Frontend**: Blade + Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Breeze + Google OAuth
- **Logging**: Spatie Activitylog
- **Roles**: Spatie Laravel Permissions

## ⚙️ Setup Instructions

1. **Clone the repository**
```bash
git clone https://github.com/lareishim/LaravelCA3.git
cd LaravelCA3
```

2. **Install dependencies**
```bash
composer install
npm install
npm run build
```

3. **Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Set up database**
```bash
php artisan migrate --seed
```

5. **Run the server**
```bash
php artisan serve
```

6. **Login credentials**
Use the seeded admin account or register with Google.

## 📸 Screenshots

_(You can paste screenshots here of the dashboard, message inbox, and player profiles.)_

## 🚀 Future Enhancements

- Reactions on posts
- Notifications for liked players
- Real-time chat among fans
- Spotify API integration for live Afrobeats playlists

## 📄 License

This project is for educational and creative collaboration by **David Ailemen** and **Lare Adekeye**. All rights reserved.