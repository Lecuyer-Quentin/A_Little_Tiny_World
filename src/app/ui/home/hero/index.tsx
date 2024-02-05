import Image from 'next/image'

type Props = {
  image: string,
  title: string,
  description: string
}

export default function Hero({image, title, description}: Props) {
  
  return (
    <section className='w-full h-auto flex flex-col justify-center items-center'>
    <Image src={image} alt="logo" width={400} height={400} />

    <div className=''>
      <h1 className=''>{title}</h1>
      <p className=''>{description}</p>
    </div>
    </section>
  )
}
