'use client'

import { NavigationMenu, NavigationMenuContent, NavigationMenuIndicator, NavigationMenuItem, NavigationMenuLink, NavigationMenuList, NavigationMenuTrigger, NavigationMenuViewport, navigationMenuTriggerStyle } from "@/components/ui/navigation-menu"
import { Button } from "@/components/ui/button"
import { useRouter } from 'next/navigation'
import { useState } from 'react'
import MenuItem from "../dashboard/menu/menu-item"

const menuList = [
  {
    title: "Categories",
    href: "/",
    default_render : () => {
      return(
        <div>
          <h1>Les Categories</h1>
        </div>
      )
    },
    list:[
      {
        title: "Chouchous",
        href: "/",
        description: "Les chouchous sont ",
        render : () => {
          return(
            <>
              <h1>Chouchous</h1>
              <p>Nos chouchous sont fabriqués à partir de tissus de qualité, et sont disponibles en plusieurs coloris et motifs.</p>
              <div className='flex flex-col'>
                <h2>Les Promos</h2>
                <p>Render prom composant</p>
              </div>
              <div className='flex flex-col'>
                <h2>Les Nouveautés</h2>
                <p>Render nouveautés composant</p>
              </div>
              <div className='flex flex-col'>
                <h2>Les Best Sellers</h2>
                <p>Render best sellers composant</p>
              </div>
            </>
          )
        },
      },
      {
        title: "Lingettes",
        href: "/",
        description: "Les lingettes sont ",
        render : () => {
          return(
            <div>
              <h1>Lingettes</h1>
            </div>
          )
        }
      },
      {
        title: "Bavoirs",
        href: "/"
      },
      {
        title: "Bavettes",
        href: "/"
      },
      {
        title: "Coussins",
        href: "/"
      },
      {
        title: "Pochettes",
        href: "/"
      },
      {
        title: "Mitaines-Berets",
        href: "/"
      },
      {
        title: "Snoods",
        href: "/"
      },
      {
        title: "Créations Uniques",
        href: "/"
      },
    ]
  },
  {
    title: "Accueil",
    href: "/",
  },
  {
    title: "Prestations",
    default_render : () => {
      return(
        <div>
          <h1>Les Prestations</h1>
        </div>
      )
    },
    href: "/prestations",
    list:[
      {
        title: "Retouche",
        href: "/"
      },
      {
        title: "Formation",
        href: "/"
      },
      {
        title: "Consulting",
        href: "/"
      }
    ]
  },
  {
    title: "Boutique",
    href: "/about",
  },
  {
    title: "Contact",
    href: "/contact",
  },
  {
    title: "L'Atelier",
    default_render : () => {
      return(
        <div>
          <h1>L&apos;Atelier</h1>
        </div>
      )
    },
    href: "/atelier",
    list:[
      {
        title: "L'Atelier",
        href: "/"
      },
      {
        title: "L'Equipe",
        href: "/"
      },
      {
        title: "Les Partenaires",
        href: "/"
      },
      {
        title: "Les Evénements",
        href: "/"
      },
      {
        title: "La Presse",
        href: "/"
      },
      {
        title: "Les Réseaux",
        href: "/"
      },
      {
        title: "Les Offres",
        href: "/"
      }
    ]
  }
]


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

    const [currentContent, setCurrentContent] = useState<JSX.Element | null>(null)

    const renderNavigationMenu = (menuList: MenuItem[]) => {
      return(
        <NavigationMenu onMouseLeave={() => setCurrentContent(null)}>
          {renderMenuItems(menuList)}
        </NavigationMenu>
      )
    }

    const renderMenuItems = (menuList: MenuItem[]) => {
      return(
        <NavigationMenuList>
          {menuList.map((item, index) => renderMenuItem(item, index))}
        </NavigationMenuList>
      )
    }
  
    const renderMenuItem = (item: MenuItem, index: number) => {
      const { title, href, list, default_render } = item
      return(
        <NavigationMenuItem key={index}>
          {list && 
          <NavigationMenuTrigger>
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

        <NavigationMenuContent className=' border-r-2 border-l-2 border-purple-400'>

            <div className='flex justify-between items-center p-4  w-[38rem] '>

              <NavigationMenuList className="w-[10rem] flex flex-col border-r-2 border-purple-400 justify-start items-start">
                {list.map((item, index) => renderMenuSubItem(item, index))}
              </NavigationMenuList>

              <div className='w-[26rem] flex flex-col items-start justify-between'>
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
                  onClick={() => setCurrentContent(render ? render() : null)}>
            {title}
          </Button>
        </NavigationMenuItem>
      )
    }


    return renderNavigationMenu(menuList as MenuItem[])
  }
    
