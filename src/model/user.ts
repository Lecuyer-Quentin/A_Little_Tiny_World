import mongoose from "mongoose"

const userSchema = new mongoose.Schema({
    username: { type: String, min: 3, max: 20,}, // unique: true, required: [true, "Username is required"]},
    email: { type: String, unique: true, required: [true, "Email is required"]},
    password: { type: String, required: [true, "Password is required"]},
    name: { type: String, min: 3, max: 20},
    lastName: { type: String, min: 3, max: 20},
    role: { type: String, default: "user", enum: ["user", "admin", "dev"]},
    image: { type: String, default: "https://res.cloudinary.com/dkkgmzpqd/image/upload/v1627668859/avatars/default-avatar.png" },
    createdAt: { type: Date, default: Date.now },
    updatedAt: { type: Date, default: Date.now }
},
    { timestamps: true }
)

export interface UserModel {
    username: string;
    email: string;
    password: string;
    name: string;
    lastName: string;
    role: string;
    image: string;
    createdAt: Date;
    updatedAt: Date;
}


const User = mongoose.models.User || mongoose.model<UserModel>("User", userSchema);

export default User;

