import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger} from "@/components/ui/dialog"
import { Button } from "@/components/ui/button";
import GoogleAuthBtn from "@/app/components/button/authBtn/googleAuth";
import AppleAuthBtn from "@/app/components/button/authBtn/appleAuth";
import FacebookAuthBtn from "@/app/components/button/authBtn/facebookAuth";




export default function LoginWrapper({children} : {children: React.ReactNode}) {
    return (
        <Dialog>
            <DialogTrigger asChild>
                <Button className=" p-3 bg-black text-white rounded-lg">Login</Button>
            </DialogTrigger>

            <DialogContent className="flex flex-col justify-between items-center text-center gap-5 p-5 py-10 w-96 h-100 rounded-lg shadow-lg">
                <DialogHeader>
                    <DialogTitle className="text-black text-center"
                    >Bienvenue dans A Little Tiny World</DialogTitle>
                    <DialogDescription className="text-gray-500 text-center">
                        La couture à porter de main
                    </DialogDescription>
                </DialogHeader>
                {children}
                <DialogFooter>
                    <GoogleAuthBtn />
                    <AppleAuthBtn />
                    <FacebookAuthBtn />
                </DialogFooter>
            </DialogContent>
        </Dialog>
    )
}