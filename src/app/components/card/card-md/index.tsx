'use client'

import { Card, CardContent, CardTitle, CardDescription, CardFooter  } from "@/components/ui/card"
import Image from "next/image"
import { useState } from "react"
import RouterBtn from "../../button/routerBtn"
import { Product } from "../../../../../types"
import { useEffect } from "react"



export default function CardMd ({ data }: { data: Product }) {


    const [isHover, setIsHover] = useState(false)
    const [cardData, setCardData] = useState<Product>(data)

    useEffect(() => {
        setCardData(data)
    }, [data])        

    const {_id, title, description, price, inStock, category } = cardData
    const url = `/product/${_id}`

    const handleMouseEnter = () => {
        setIsHover(true)
    }
    const handleMouseLeave = () => {
        setIsHover(false)
    }


    const renderTitle = () => {
        return (
            <CardTitle className=" font-semibold text-center pt-5">
                {description}
            </CardTitle>
        )
    }

    const renderDescription = () => {
        return (
            <CardDescription className="font-semibold text-center ">
                {title}
            </CardDescription>
        )
    }

    const renderPrice = () => {
        return (
            <CardDescription className="font-semibold text-center">
                {price}
            </CardDescription>
        )
    }

    const renderInStock = () => {
        return (
            <CardDescription className="font-semibold text-center">
                {inStock ? 'In Stock' : 'Out of Stock'}
            </CardDescription>
        )
    }

    const renderCategory = () => {
        return (
            <CardDescription className="font-semibold text-center">
                {category}
            </CardDescription>
        )
    }

    return (
        <Card className=" w-52 h-72 flex flex-col justify-between items-center relative" onMouseEnter={handleMouseEnter} onMouseLeave={handleMouseLeave}>
            {renderTitle()}
            {renderDescription()}
            {renderPrice()}
            {renderInStock()}
            {renderCategory()}
            <CardFooter>
                <RouterBtn url={url} title="View Product" />
            </CardFooter>
        </Card>
    )

}