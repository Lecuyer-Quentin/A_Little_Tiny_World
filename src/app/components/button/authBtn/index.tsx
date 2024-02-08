

import { Button } from "@/components/ui/button";
import { signIn } from "next-auth/react";

type AuthBthProps = {
    provider: string,
    icon: React.ReactNode,
    }
    
export default function AuthBth({provider, icon}: AuthBthProps) {

    const handleAuth = async () => {
        await signIn(provider, {
            callbackUrl: 'http://localhost:3000'
        })
    }

    const renderAuthBtn = () => {
        return (
            <Button size="icon" onClick={handleAuth}>
                {icon}
            </Button>
        )
    }
  return renderAuthBtn()
}
