import { Button } from "@/components/ui/button";
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuTrigger } from "@/components/ui/dropdown-menu"
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar"
import OptionList from "./option-list";

type UserOptionProps = {
    name: string | null | undefined;
    email: string | null | undefined;
    image: string | null | undefined;
}


export default function UserOption({name, email, image}: UserOptionProps) {


    const renderAvatar = () => {
        return (
            <Avatar>
                <AvatarFallback>{name?.charAt(0)}</AvatarFallback>
                <AvatarImage src={image!} alt={name!} />
            </Avatar>
        )
    }


    const renderUserOption = () => {
        return (
            <DropdownMenu>
                <DropdownMenuTrigger asChild>
                    <Button variant="link">
                    {name}
                    </Button>
                </DropdownMenuTrigger>
                <DropdownMenuContent>
                    <DropdownMenuLabel className="flex items-center space-x-2 gap-2">
                        {image ? renderAvatar() : null}
                        {name}
                    </DropdownMenuLabel>
                    <DropdownMenuSeparator />

                    <OptionList />
                    
                </DropdownMenuContent>
            </DropdownMenu>
        )
    }
    return renderUserOption()
    }
