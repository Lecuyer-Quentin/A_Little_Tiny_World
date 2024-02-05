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
                image: session.user?.image
            }

            return (
                <>  
                <UserOption name={user.name} email={user.email} image={user.image} />
                    <Button onClick={() => signOut()} variant="link">
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