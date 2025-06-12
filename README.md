# Laravel API

## Auth Routes API Endpoints

| Method | Endpoint                           | Description                             |
| ------ | ---------------------------------- | --------------------------------------- |
| POST   | `/api/auth/register`               | Register a new user                     |
| POST   | `/api/auth/login`                  | Login and get token                     |
| GET    | `/api/auth/google`                 | Redirect to Google for authentication   |
| GET    | `/api/auth/google/callback`        | Handle Google login callback            |
| GET    | `/api/auth/facebook`               | Redirect to Facebook for authentication |
| GET    | `/api/auth/facebook/callback`      | Handle Facebook login callback          |
| POST   | `/api/auth/password/reset/otp`     | Send password reset OTP                 |
| POST   | `/api/auth/password/reset/verify`  | Verify the OTP                          |
| POST   | `/api/auth/password/reset/confirm` | Confirm new password                    |
| POST   | `/api/auth/logout`                 | Logout user (Requires auth)             |
| GET    | `/api/profile`        | Get authenticated user profile |
| PUT    | `/api/profile`        | Update user name               |
| POST   | `/api/profile/avatar` | Update user avatar             |
| DELETE | `/api/profile`        | Delete user account            |
| GET    | `/api/notifications` | List user notifications |
| POST   | `/api/ai/recommend/emotions` | Get emotion-based recommendations          |
| POST   | `/api/ai/recommend/content`  | Get content-based recommendations          |
| GET    | `/api/ai/emotions`           | List available emotions for recommendation |

