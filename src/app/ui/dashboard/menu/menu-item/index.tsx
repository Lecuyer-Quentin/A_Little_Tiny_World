'use client'

import { Button } from "@/components/ui/button";
import { useRouter } from "next/navigation";

export default function MenuItem({subItem}: {subItem: {title: string, href: string, icon: React.ReactNode}}) {
    const router = useRouter()

    const handleClick = () => {
        router.push(subItem.href)
    }

    const renderMenuItem = () => {
        return (
            <li className="mt-1 relative group">
                <span className="absolute inset-y-0 left-0 w-1 bg-blue-400 rounded-tr-lg rounded-br-lg group-hover:bg-blue-600" aria-hidden="true" />
      
                <Button
                    variant={"ghost"}
                    onClick={handleClick}
                    className="w-full flex justify-start text-black py-2 text-sm font-medium gap-4 group:hover:bg-blue-100 group-hover:text-blue-600">
                    {subItem.icon}
                    {subItem.title}
                </Button>
            </li>
        )
    }
    return renderMenuItem()
  }