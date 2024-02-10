'use client'

import { useSession, signOut } from "next-auth/react";
import { Button } from "@/components/ui/button";
import { MdLogout } from "react-icons/md";
import LogModal from "@/app/components/log-modal";
import UserOption from "../user-option";



export default function AuthStatus(){

    const {data: session } = useSession()

    const renderAuthBtn = () => {
        if(session) {
            const user = {
                name: session.user?.name,
                email: session.user?.email,
                image: session.user?.image,
                role : session.user?.role,
            }

            return (
                <>  
                <UserOption name={user.name} email={user.email} image={user.image} role={user.role} />
                    <Button onClick={() => signOut()} variant="link">
                        {user.role === "admin" || user.role === "dev" ? <span className="text-2xl">👑</span> : null}
                        {user.role === "user" ? <span className="text-2xl">👤</span> : null}
                        <MdLogout className="text-2xl" />
                    </Button>
                </>
            )
        }
        return (
            <>
                <LogModal />
            </>
        )
    }
    return renderAuthBtn()
}