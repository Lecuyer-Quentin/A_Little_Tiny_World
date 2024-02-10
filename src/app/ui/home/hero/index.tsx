import Image from 'next/image'


export default function Hero() {

  const renderBackground = () => {
    const images = '/images/champs-de-lavande.jpg'
    return (
      <div className='absolute h-full w-full top-0 left-0 -z-10 opacity-70 rounded-lg'
        style={{
          backgroundImage: `url(${images})`, 
          backgroundPosition: 'center', 
          backgroundSize: 'cover',
        }} />      
    )
  }

  const renderLogo = () => {
    const image = '/images/logo-hero.png'
    return (
      <Image src={image} alt="logo" width={600} height={600} className='z-10' />
    )
  }

  const renderHero = () => {
    return (
      <section className='w-full h-[10rem] flex flex-col justify-center items-center relative rounded-lg'>
        {renderBackground()}
        <div className='absolute w-full h-full bg-black opacity-10 rounded-lg' />
        {renderLogo()}
      </section>
    )
  }
  
  return renderHero()
}
