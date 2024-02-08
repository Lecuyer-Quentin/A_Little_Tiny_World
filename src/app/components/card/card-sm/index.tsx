'use client'

import { Card, CardContent, CardTitle, CardDescription, CardFooter  } from "@/components/ui/card"
import Image from "next/image"
import { useRouter } from "next/navigation"
import { useState } from "react"
import RouterBtn from "../../button/routerBtn"

type CardSMProps = {
    data: {
        _id: number | string
        title: string
        description: string
        image: string
        alt: string
    }
}



export default function CardSM({ data }: CardSMProps) {
    const [isHover, setIsHover] = useState(false)

    const {_id, title, description, image, alt } = data
    const router = useRouter()

    const handleClick = () => {
        router.push(`/product/${_id}`)
    }
    const handleMouseEnter = () => {
        setIsHover(true)
    }
    const handleMouseLeave = () => {
        setIsHover(false)
    }

    const renderImage = () => {
        return (
            <Image src={image} alt={alt} layout="fill" className="rounded-lg p-[.1rem]" />
        )
    }

    const renderTitle = () => {
        return (
            <div className="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 rounded-lg">
                <CardTitle className="text-white font-semibold text-center pt-5">
                    {description}
                </CardTitle>
            </div>
        )
    }

    const renderDescription = () => {
        return (
            <CardDescription className="text-white font-semibold text-center ">
                {title}
            </CardDescription>
        )
    }

    const renderButton = () => {
        return (
            <RouterBtn title="Voir plus" url={`/product/${_id}`} />
        )
    }

    const renderCard = () => {
        return (
            <Card onClick={handleClick} onMouseEnter={handleMouseEnter} onMouseLeave={handleMouseLeave}
                className='relative w-[10rem] h-[10rem] bg-black border-none cursor-pointer'>
                <CardContent>
                    {renderImage()}
                    {isHover ? renderTitle() : null}
                </CardContent>
                <CardFooter className="absolute bottom-0 w-full h-2/5 rounded-b-lg pt-5 flex justify-center items-center">
                    {isHover ? renderButton() : renderDescription()}
                </CardFooter>
            </Card>
        )
    }

    return renderCard()
}

