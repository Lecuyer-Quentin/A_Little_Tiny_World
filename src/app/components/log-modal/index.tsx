import { useState } from "react";  
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTrigger} from "@/components/ui/dialog"
import Image from "next/image";
import { Button } from "@/components/ui/button";
import LoginForm from "@/app/components/form/login";
import RegisterForm from "@/app/components/form/register";

export default function LogModal () {
    const [show, setShow] = useState(false)

    const toggleShow = () => {
        setShow(!show)
    }

    return (
        <>
            <Dialog>
                <DialogTrigger asChild>
                    <Button variant={'link'}> Connexion </Button>
                </DialogTrigger>

                <DialogContent className="flex flex-col items-center w-96 h-auto">
                    <DialogHeader>
                        <Image src="/images/logo.jpg" alt="logo" width={300} height={100} />
                    </DialogHeader>


                    {!show 
                        ? <LoginForm /> 
                        : <RegisterForm />
                    }

                    <DialogFooter>
                    <DialogDescription>
                        {show 
                            ? "Déjà inscrit ?"
                            : "Pas encore inscrit ?"
                        }
                        <Button onClick={toggleShow} variant="link" className="text-black">
                            {show 
                                ? "Se connecter"
                                : "S'inscrire"
                            }
                        </Button>
                    </DialogDescription>
                </DialogFooter>
                </DialogContent>


            </Dialog>
        </>
    )
}