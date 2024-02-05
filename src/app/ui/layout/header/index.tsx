import Navigation from '../../navigation'
import UserStatus from '../../user-status'
import Image from 'next/image'


export default function Header() {

  const renderLogo = () => {
    return(
        <Image className='absolute top-2 left-4 z-50'
        src='/images/logo-hero.png' alt='logo' width={150} height={150} />
    )
  }
 

  const renderHeader = () => {
    return(
      <header className='flex flex-col bg-white z-50'>


        <div className='flex justify-end items-center sticky top-0 bg-white z-50'>
          {renderLogo()}
          <UserStatus />
        </div>
          

        <nav className='flex justify-center items-center p-4'>
          <Navigation />
        </nav>
      </header>
    )
  }

  return renderHeader()
}






