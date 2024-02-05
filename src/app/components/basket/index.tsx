import { Sheet, SheetContent, SheetDescription, SheetHeader, SheetTitle, SheetTrigger } from "@/components/ui/sheet"
import { Button } from "@/components/ui/button"
import { CiShoppingBasket } from "react-icons/ci";

import BasketList from "../basket-list";

export default function Basket() {

    const renderBasket = () => {
        return (
            <Sheet>
                <SheetTrigger asChild>
                    <Button variant={'link'}>
                        <CiShoppingBasket className="text-2xl" />
                        (0)
                    </Button>
                </SheetTrigger>

                <SheetContent className="flex flex-col items-center w-96 h-auto">
                    <SheetHeader>
                        <SheetTitle>Panier</SheetTitle>
                    </SheetHeader>

                    <SheetDescription>
                    </SheetDescription>

                    <BasketList />
                    
                </SheetContent>
            </Sheet>
        )
    }

    return renderBasket()
}
