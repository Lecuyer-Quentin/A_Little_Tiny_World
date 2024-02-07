import { NextResponse } from "next/server";
import { createUser } from "@/utils/controller/user";
import { UserModel } from "@/model/user";

export async function POST(req: Request) {
    const { email, password } = await req.json();
    // Check if email and password are provided
    if (!email || !password) {
        return NextResponse.json({ error: "Email and password are required" });
    }
    const user = { email, password } as UserModel;

    try{
        // Create the user
        const newUser = await createUser(user);
        return NextResponse.json({ message: "User created", user: newUser }, { status: 201 });
    } catch (error) {
        return NextResponse.json({ message: "Error creating User"}, { status: 500 });
    }
}
