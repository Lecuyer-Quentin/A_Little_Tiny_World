'use client'

import { Button } from "@/components/ui/button"
import { useRouter } from "next/navigation"
import Image from 'next/image'

type RouterBtnProps = {
    title: string 
    url: string 
    asChild?: boolean
    className?: string
    image?: string 
    variant?: "link" | "default" | "destructive" | "outline" | "secondary" | "ghost" | null | undefined
    icon?: React.ReactNode
}

export default function RouterBtn({ title, url, asChild, className, image, variant, icon }: RouterBtnProps ) {
    const router = useRouter()

    const handleClick = (url: string) => {
        router.push(url)
    }

    const handleClickTarget = (url: string) => {
        window.open(url, '_blank')
    }

    const renderImage = (image: string) => {
        return (
            <Image src={image} alt={title} width={40} height={40} />
        )
    }

    return (
        <Button asChild={asChild} variant={variant} onClick={() => handleClick(url)} className={className}

                //? Permet de passer des props conditionnelles ?//}
                {...(variant && { variant: variant })}

                {...(image && { size: 'icon' })}
                {...(image && { variant: 'ghost' })}
                {...(image && { onClick: () => handleClickTarget(url) })}

                {...asChild && { asChild: asChild }}
                {...className && { className: className }}
        >
            <>
            {image && renderImage(image)}
            {icon 
                ? icon 
                : null
            }
            {!image && title}
            </>
           
        </Button>
    )
}
