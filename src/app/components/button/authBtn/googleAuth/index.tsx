import { FcGoogle } from "react-icons/fc";
import { Button } from "@/components/ui/button";
import { signIn } from "next-auth/react";


export default function GoogleAuthBtn(){
        const renderGoogleSignIn = () => {
            return (
                <Button size="icon" onClick={() => signIn('google')}>
                    <FcGoogle className="h-5 w-5" />
                </Button>
            )
        }

    return renderGoogleSignIn()
}