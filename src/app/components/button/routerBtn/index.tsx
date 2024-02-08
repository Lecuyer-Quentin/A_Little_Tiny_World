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
}

export default function RouterBtn({ title, url, asChild, className, image }: RouterBtnProps ) {
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
        <Button asChild={asChild} onClick={() => handleClick(url)} className={className}

                //? Permet de passer des props conditionnelles ?//}
                {...(asChild && { size: 'icon' })}
                {...(asChild && { variant: 'ghost' })}
                {...(asChild && { onClick: () => handleClickTarget(url) })}
        >
            {asChild && image 
                ? renderImage(image) 
                : title
            }
        </Button>
    )
}
