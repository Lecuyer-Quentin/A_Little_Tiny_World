import { DefaultSession, DefaultUser } from "next-auth";
import { JWT, DefaultJWT } from "next-auth/jwt";

declare module "next-auth" {
    /**
     * Returned by `useSession`, `getSession` and received as a prop on the `Provider` React Context
     */
    interface Session extends DefaultSession {
            user: User;
            token: JWT;
    }

    /**
     * Returned by `getSession`, and received as a prop on the `Provider` React Context
     */
    interface User extends DefaultUser {
        id: string;
        name: string;
        email: string;
        role: string;
        image: string;
    }
    
}

declare module "next-auth/jwt" {
    interface JWT extends DefaultJWT {
        role: string,
        id: string,
    }
}