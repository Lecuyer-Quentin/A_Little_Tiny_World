import { NextAuthOptions, User } from 'next-auth'
import clientPromise from '@/lib/mongoAdapter'
import { MongoDBAdapter } from "@auth/mongodb-adapter"
import { authorizeUser } from '@/utils/controller/user'
import GoogleProvider from 'next-auth/providers/google'
import FacebookProvider from 'next-auth/providers/facebook'
import CredentialsProvider from 'next-auth/providers/credentials'


interface Credentials{
    email: string;
    password: string;
}

//? This is the configuration for the NextAuth module
export const options: NextAuthOptions = {
    adapter: MongoDBAdapter(clientPromise),
    session: {strategy: "jwt"},
    secret: process.env.MONGODB_URI as string,
    callbacks: {
        async jwt(parameters) {
            const { token, user } = parameters
            if (user) token.user = user as User
            return token
        },  
        async session(parameters) {
            const { session, token } = parameters
            if (token) session.user = token.user as User
            return Promise.resolve(session)
        },
    },

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
            id: "credentials",
            name: "credentials",
            credentials: {
                email: { label: "Email: ", type: "email", placeholder: "Enter your email" },
                password: {  label: "Password: ", type: "password", placeholder: "***********" }
            },
            async authorize(credentials) {
                const { email, password } = credentials as Credentials
                try {
                    const user = await authorizeUser({ email, password })
                    return user
                } catch (error) {
                    throw new Error('Invalid credentials')
                }
            }
        }),
    ],
}

export default options


