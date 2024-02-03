import { NextAuthOptions } from 'next-auth'
import clientPromise from '@/lib/mongoAdapter'
import { MongoDBAdapter } from "@auth/mongodb-adapter"

import GoogleProvider from 'next-auth/providers/google'
import { GoogleProfile } from 'next-auth/providers/google'
import FacebookProvider from 'next-auth/providers/facebook'
import { FacebookProfile } from 'next-auth/providers/facebook'
import CredentialsProvider from 'next-auth/providers/credentials'


//? This is the configuration for the NextAuth module
export const options: NextAuthOptions = {
    providers: [
        GoogleProvider({
            clientId: process.env.GOOGLE_ID as string,
            clientSecret: process.env.GOOGLE_SECRET as string,
        }),
        FacebookProvider({
            clientId: process.env.FACEBOOK_ID as string,
            clientSecret: process.env.FACEBOOK_SECRET as string,
        }),
        CredentialsProvider({
            name: "Credentials",
            credentials: {
                email: { label: "Email: ", type: "email", placeholder: "Enter your email" },
                password: {  label: "Password: ", type: "password", placeholder: "***********" }
            },
            async authorize(credentials) {
                //todo: change to the correct url
                const res = await fetch(`${process.env.NEXTAUTH_URL}/api/auth/login`, {
                    method: "POST",
                    body: JSON.stringify(credentials),
                    headers: { "Content-Type": "application/json" }
                })
                const user = await res.json()
                if (res.ok && user) {
                    return user
                }
                return null
            }
        }),
    ],
    //? works anyway
    adapter: MongoDBAdapter(clientPromise),
    


    
}


