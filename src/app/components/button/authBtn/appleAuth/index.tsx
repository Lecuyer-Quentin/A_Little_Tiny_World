import { FaApple } from "react-icons/fa";
import { signIn } from "next-auth/react";
import { Button } from "@/components/ui/button";

export default function AppleAuthBtn(){
    
    const renderAppleSignIn = () => {
        return (
            <Button size="icon" onClick={() => signIn('apple')}>
                <FaApple className="h-5 w-5"/>
            </Button>
        )
    }

    return renderAppleSignIn()

}
