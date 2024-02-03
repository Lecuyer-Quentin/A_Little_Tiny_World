import mongoose from "mongoose"

const UserSchema = new mongoose.Schema({
    username: {
        type: String,
        default: "User",
        min: 3,
        max: 20,
        //required: [true, "Username is required"],
    },
    email: {
        type: String,
        match: [/\S+@\S+\.\S+/, "is invalid"],
        min: 3,
        max: 50,
        unique: true,
       // required: [true, "Email is required"],
    },
    password: {
        type: String,
        match: [/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,}$/, "is invalid"],
        min: 6,
        max: 20,
        //required: [true, "Password is required"],
    },
    uid: {
        type: String,
        unique: true,
        //required: [true, "UID is required"],
    },
    role: {
        type: String,
        default: "user",
        enum: ["user", "admin"],
    },
    refreshToken: {
        type: String,
        default: null,
    },
    accessToken: {
        type: String,
        default: null,
    },
    forgotPasswordToken: {
        type: String,
        default: null,
    },
    forgotPasswordTokenExpiry: {
        type: Date,
        default: null,
    },
    verifyToken: {
        type: String,
        default: null,
    },
    verifyTokenExpiry: {
        type: Date,
        default: null,
    },
    createdAt: {
        type: Date,
        default: Date.now,
    },
    updatedAt: {
        type: Date,
        default: Date.now,
    },
},
    { timestamps: true }
)

const User = mongoose.models.User || mongoose.model("User", UserSchema)
export default User




