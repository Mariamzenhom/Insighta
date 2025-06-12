# 🚀 Authentication APIs
Everything related to login, registration, and password recovery.
| Method | Endpoint                           | Description                                |
| ------ | ---------------------------------- | ------------------------------------------ |
| `POST` | `/api/auth/register`               | 🧾 Register a new user                     |
| `POST` | `/api/auth/login`                  | 🔐 Log in and receive access token         |
| `GET`  | `/api/auth/google`                 | 🌐 Redirect to Google for login            |
| `GET`  | `/api/auth/google/callback`        | 🔁 Handle Google login callback            |
| `GET`  | `/api/auth/facebook`               | 🌐 Redirect to Facebook for login          |
| `GET`  | `/api/auth/facebook/callback`      | 🔁 Handle Facebook login callback          |
| `POST` | `/api/auth/password/reset/otp`     | ✉️ Send OTP to reset password              |
| `POST` | `/api/auth/password/reset/verify`  | ✅ Verify the received OTP                  |
| `POST` | `/api/auth/password/reset/confirm` | 🔑 Set a new password                      |
| `POST` | `/api/auth/logout`                 | 🚪 Logout the current user (auth required) |


# 👤 User Profile APIs
Manage user profile, avatar, and account.
| Method   | Endpoint              | Description                                |
| -------- | --------------------- | ------------------------------------------ |
| `GET`    | `/api/profile`        | 📄 Retrieve authenticated user’s profile   |
| `PUT`    | `/api/profile`        | 📝 Update user’s name                      |
| `POST`   | `/api/profile/avatar` | 🖼 Upload or update profile avatar         |
| `DELETE` | `/api/profile`        | ❌ Delete account (requires password check) |


# 🔔 Notifications API
User notification system.
| Method | Endpoint             | Description                       |
| ------ | -------------------- | --------------------------------- |
| `GET`  | `/api/notifications` | 📬 Get all notifications for user |


# 🤖 AI Recommendation APIs
Get smart recommendations based on user behavior or emotional state.
| Method | Endpoint                     | Description                            |
| ------ | ---------------------------- | -------------------------------------- |
| `POST` | `/api/ai/recommend/emotions` | 🎭 Recommend content based on emotions |
| `POST` | `/api/ai/recommend/content`  | 🎯 Recommend content by preferences    |
| `GET`  | `/api/ai/emotions`           | 🧠 List available emotion tags         |
