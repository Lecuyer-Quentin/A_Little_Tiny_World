

export default function Footer() {

            
    const renderBackground = () => {
        const image = '/images/flower.png'
        return (
            <div className='absolute w-full h-full top-0 left-0 -z-10 opacity-70'
                style={{backgroundImage: `url(${image})`,
                backgroundPosition: 'center',
                backgroundSize: 'cover',
                transform: 'rotate(180deg)'
                 }}>
            </div>
        )
    }


    const renderFooter = () => {
        return (
            <footer className=' w-full h-[20rem] relative flex flex-col justify-center items-center'>
                {renderBackground()}
                <p className='absolute bottom-0 text-center py-5 font-semibold'>© 2024 A Little Tiny World</p>
        </footer>
        )
    }

    
  return renderFooter()
}
