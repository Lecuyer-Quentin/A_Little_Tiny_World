'use client'

import { useSession, signOut } from "next-auth/react";
import { Button } from "@/components/ui/button";
import LoginForm from "../../../form/login";
import LoginWrapper from "../../../container/loginForm";
  


export default function AuthBtn(){

    const {data: session } = useSession()

    const renderAuthBtn = () => {
        if(session) {
            return (
                <>
                    Signed in as {session?.user?.email} <br />
                    <Button onClick={() => signOut()}>
                        Log Out
                    </Button>
                </>
            )
        }
        return (
            <>
                <LoginWrapper>
                    <LoginForm />
                </LoginWrapper>
                
            </>
        )
    }
    return renderAuthBtn()
}