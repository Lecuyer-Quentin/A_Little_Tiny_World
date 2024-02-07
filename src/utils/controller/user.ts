import User from "../../model/user";
import { UserModel } from "../../model/user";
import { hashPassword, comparePassword } from "@/lib/bcript";
import dbConnect from "@/lib/mongoDb";
import { NextResponse } from "next/server";


// Omit is a utility type that allows you to create a new type by omitting properties from an existing type.
type Props = Omit<UserModel, 'createdAt' | 'updatedAt'>;

////////////////////////////////////////////////////////////////////////////////////////
//  This function is used to create a new user in the database
export const createUser = async (user: Props) => {

    const name = user.email.split('@')[0].split('.')[0].split('_').join(' ');
    const firstChar = name.charAt(0).toUpperCase();
    const nameToRender = firstChar + name.slice(1);


    // User object that will be added to the database
    const userAdded : Props = {
        ...user,
        name: nameToRender,
        password: await hashPassword(user.password)
    }

    try{
        // Connect to the database
        await dbConnect();
        // Check if email and password are provided
        if(!userAdded.email || !userAdded.password) {
            return NextResponse.json({ message: "Email and password are required" }, { status: 400 });
        }
        // Check if the user already exists
        const findUser = await User.findOne({ email: userAdded.email });
        if (findUser){
            return NextResponse.json({ message: "User already exists" }, { status: 400 });
        }

        // Create the user
        const newUser =  await User.create(userAdded);
        return newUser;
    } catch (error) {
        return NextResponse.json({ message: "Error creating User"}, { status: 500 });
    }
};
////////////////////////////////////////////////////////////////////////////////////////


// This function is used to find a user by email
export const getUserByEmail = async (email: string) => {
    if (!email) throw new Error('Email is required');
    const user = await User.findOne({ email});
    if (!user) throw new Error('No User Found')
    return user;
}

export const authorizeUser = async (credentials: { email: string, password: string }) => {
    const { email, password } = credentials;
    const user = await getUserByEmail(email);
    if (!user) throw new Error('No user found');
    const isValid = await comparePassword(password, user.password);
    if (!isValid) throw new Error('Invalid password');
    return user;
}