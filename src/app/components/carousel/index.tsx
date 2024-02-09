'use client'

import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from "@/components/ui/carousel"
import Autoplay from "embla-carousel-autoplay"
import CardSM from "../card/card-sm"

type CarouselSMProps = {
    data: {
        _id: number | string
        title: string
        description: string
        image: string
        alt: string
    }[]
}

  export default function CarouselSM({ data }: CarouselSMProps) {

    const renderContent = ({ data }: CarouselSMProps) => {
        return (
            data.map((item, _id) => (
                <CarouselItem key={_id} className="basis-1/2 lg:basis-1/4">
                    <CardSM data={item} />
                </CarouselItem>
            ))
        )
    }

    const renderCarousel = () => {
        return (
            <Carousel 
                plugins={[
                    Autoplay({ 
                        delay: 3000,
                        stopOnMouseEnter: true,
                        stopOnInteraction: false,
                        stopOnFocusIn: true, 
                    }),
                ]}
                opts={{
                    loop: true,
                    }}
                className="w-full h-auto"
            >
                <CarouselContent>
                    {renderContent({ data })}
                </CarouselContent>
            </Carousel>
        )
    }
    return renderCarousel()
}