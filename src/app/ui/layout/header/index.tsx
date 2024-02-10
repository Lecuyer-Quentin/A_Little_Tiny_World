import Navigation from '../../navigation'
import UserStatus from '../../user-status'
import Image from 'next/image'


export default function Header() {

  const renderLogo = () => {
    return(
        <Image className='absolute top-2 left-4 z-50 hidden md:block'
        src='/images/logo-hero.png' alt='logo' width={150} height={150} />
    )
  }
 

  const renderHeader = () => {
    return(
      <header className='flex flex-col fixed z-50 w-full'>
        <div className=' flex justify-end items-center bg-white z-50'>
          {renderLogo()}
          <UserStatus />
        </div>
          
        <Navigation />
      </header>
    )
  }

  return renderHeader()
}






