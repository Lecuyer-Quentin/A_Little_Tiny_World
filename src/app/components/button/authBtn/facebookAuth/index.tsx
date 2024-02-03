import { FaFacebook } from "react-icons/fa";
import { signIn } from "next-auth/react";
import { Button } from "@/components/ui/button";


export default function FacebookAuthBtn(){

    const renderFacebookSignIn = () => {
        return (
            <Button size="icon" onClick={() => signIn('facebook')}>
                <FaFacebook className="h-5 w-5"  />
            </Button>
        )
    }

    return renderFacebookSignIn()

}
