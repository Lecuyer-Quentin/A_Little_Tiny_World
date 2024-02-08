import CarouselSM from "@/app/components/carousel"
import RouterBtn from "@/app/components/button/routerBtn"

const tempData = [
    {
        _id: 1,
        title: 'Les créations du moment',
        description: 'We have everything you need',
        image: '/images/knitting.jpg',
        alt: 'knitting',
    },
    {
        _id: 2,
        title: 'Les créations du moment',
        description: 'We have everything you need',
        image: '/images/lavande.jpg',
        alt: 'lavande',
    },
    {
        _id: 3,
        title: 'Les créations du moment',
        description: 'We have everything you need',
        image: '/images/champs-de-lavande.jpg',
        alt: 'champs-de-lavande',
    },
    {
        _id: 4,
        title: 'Les créations du moment',
        description: 'We have everything you need',
        image: '/images/knitting.jpg',
        alt: 'knitting',
    },
    {
        _id: 5,
        title: 'Les créations du moment',
        description: 'We have everything you need',
        image: '/images/lavande.jpg',
        alt: 'lavande',
    },
    {
        _id: 6,
        title: 'Les créations du moment',
        description: 'We have everything you need',
        image: '/images/champs-de-lavande.jpg',
        alt: 'champs-de-lavande',
    },
]


  
export default function Banner() {

    const url = '/creations'

    const renderBackground = () => {
        const images = '/images/knitting.jpg'
        return (
            <>
                <div className='absolute h-full w-full top-0 left-0 -z-10 opacity-70 rounded-lg'
                style={{
                    backgroundImage: `url(${images})`, 
                    backgroundPosition: 'center', 
                    backgroundSize: 'cover',
                }} />   
                <div className='absolute w-full h-full bg-black opacity-40 rounded-lg' />
            </>
        )}

        const renderButton = () => {
            return(
                <div className='absolute top-1 left-1 md:static md:mb-2'>
                    <RouterBtn url={url} title='Voir plus' />
                </div>
        )}

    const renderBanner = () => {
        return (
            <section className='w-full flex flex-col justify-evenly items-center relative p-4 gap-6 rounded-lg
                                md:h-[14rem] md:flex-row md:justify-evenly md:items-center'>
                {renderBackground()}

                <div className='z-10 h-[10rem] text-white text-center md:h-full pt-10 md:pt-0 md:text-left'>
                    {renderButton()} 
                    <h1 className='text-3xl font-semibold'>Les créations du moment</h1>
                    <p className='text-lg font-medium'>We have everything you need</p>
                </div>

                <div className='z-10 h-full w-full mb-10 md:mb-0 flex justify-center items-center'>
                    <CarouselSM data={tempData} />
                </div>

            </section>
        )
    }
  return renderBanner()
}
