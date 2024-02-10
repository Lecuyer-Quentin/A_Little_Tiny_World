'use client'

import { NavigationMenu, NavigationMenuContent, NavigationMenuIndicator, NavigationMenuItem, NavigationMenuLink, NavigationMenuList, NavigationMenuTrigger, NavigationMenuViewport, navigationMenuTriggerStyle } from "@/components/ui/navigation-menu"
import { Button } from "@/components/ui/button"
import { useRouter } from 'next/navigation'
import { useState, useEffect } from 'react'
import MenuItem from "../dashboard/menu/menu-item"
import { menuList } from "./data"

const background = '/images/knitting.jpg'

const renderBackground = () => {
  return(
    <div className='absolute top-0 left-0 z-0 w-full h-full border-l-2 border-r-2 border-purple-400'
         style={{backgroundImage: `url(${background})`, backgroundSize: 'cover', backgroundPosition: 'center', opacity: 0.2}}>
    </div>
  )
}


type List = {
  title: string
  href: string
  description?: string
  render?: () => JSX.Element
}
type MenuItem = {
  title: string
  href: string
  default_render?: () => JSX.Element
  list?: List[]
}

export default function Navigation() {
    const router = useRouter()
    const [lastScrollTop, setLastScrollTop] = useState(0);
    const [isVisible, setIsVisible] = useState(true);

  useEffect(() => {
    function handleScroll() {
      let st = window.pageYOffset || document.documentElement.scrollTop;
      if (st > lastScrollTop){
         setIsVisible(false);
      } else {
         setIsVisible(true);
      }
      setLastScrollTop(st <= 0 ? 0 : st);
    }

    window.addEventListener("scroll", handleScroll);
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, [lastScrollTop]);

    const [currentContent, setCurrentContent] = useState<JSX.Element | null>(null)

    const renderNavigationMenu = (menuList: MenuItem[]) => {
      return(
        <nav style={{transform: isVisible ? 'translateY(0)' : 'translateY(-100%)', transition: 'transform 0.3s ease-in-out'}}
              className='flex justify-center items-center p-2 bg-white'>
          <NavigationMenu onMouseLeave={() => setCurrentContent(null)}>
            {renderMenuItems(menuList)}
          </NavigationMenu>
        </nav>
      )
    }

    const renderMenuItems = (menuList: MenuItem[]) => {
      return(
        <NavigationMenuList>
          <div className='flex justify-center items-center flex-wrap'>
          {menuList.map((item, index) => renderMenuItem(item, index))}
          </div>
        </NavigationMenuList>
      )
    }
  
    const renderMenuItem = (item: MenuItem, index: number) => {
      const { title, href, list, default_render } = item
      return(
        <NavigationMenuItem key={index}>
          {list && 
          <NavigationMenuTrigger className="bg-transparent">
            {title}
          </NavigationMenuTrigger>
          }

          {!list &&
          <NavigationMenuLink asChild>
            <Button onClick={() => router.push(href)}
                    variant={'ghost'}>
              {title}
            </Button>
          </NavigationMenuLink>
          }


          {list && renderMenuSubItems(list, default_render ? default_render : () => <div></div>)}
        </NavigationMenuItem>
      )
    }

    const renderMenuSubItems = (list: List[], default_render: (() => JSX.Element)) => {

      return(

        <NavigationMenuContent>

            <div className='flex flex-col justify-between items-center
                            md:flex md:flex-row md:justify-between md:items-between md:w-[32rem]
                            '>
              {renderBackground()}
            

              <NavigationMenuList className="">
                <div className='flex flex-wrap justify-center items-center
                                md:flex md:flex-col md:justify-start md:items-start'>
                  {list.map((item, index) => renderMenuSubItem(item, index))}
                </div>
              </NavigationMenuList>

              <div className=' flex flex-col'>
                {currentContent 
                  ? currentContent 
                  : default_render()
                }
              </div>

            </div>

        </NavigationMenuContent>
      )
    }


    const renderMenuSubItem = (list : List, index: number) => {
      const { title, render } = list
      return(
        <NavigationMenuItem key={index}>
          <Button variant={'ghost'}
                  onClick={() => setCurrentContent(render ? render() : null)}
                  //onMouseEnter={() => setCurrentContent(render ? render() : null)}
                  >
            {title}
          </Button>
        </NavigationMenuItem>
      )
    }


    return renderNavigationMenu(menuList as MenuItem[])
  }
    
