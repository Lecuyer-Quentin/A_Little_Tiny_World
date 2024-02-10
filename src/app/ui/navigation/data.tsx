export const menuList = [
    {
      title: "Accueil",
      href: "/",
    },
    {
      title: "Boutique",
      href: "/",
      default_render : () => {
        return(
          <div className='flex flex-col justify-center items-center'>
            <h1>Bienvenue dans notre boutique</h1>
            <p>Vous trouverez ici tout ce dont vous avez besoin pour vos créations</p>
            <p>Les chouchous, les lingettes, les bavoirs, les bavettes, les coussins, les pochettes, les mitaines-berets, les snoods, les créations uniques</p>
            <div className='flex flex-wrap justify-center items-center'>
            {Array(10).fill(0).map((_, index) => {
              return(
                <div key={index} className='w-10 h-10 bg-purple-400 m-2'>
                  <p>Item {index}</p>
                </div>
              )
            })}
            </div>
          </div>
        )
      },
      list:[
        {
          title: "Chouchous",
          href: "/",
          render : () => renderRenderContent(
            {
              title: "Les Chouchous",
              description: "Nos chouchous sont fabriqués à partir de tissus de qualité, et sont disponibles en plusieurs coloris et motifs.",
              render: () => {
                return(
                  <div className='flex flex-wrap justify-center items-center'>
                    {Array(4).fill(0).map((_, index) => {
                      return(
                        <div key={index} className='w-10 h-10 bg-purple-400 m-2'>
                          <p>Item {index}</p>
                      </div>
                      )
                    })}
                  </div>
                )
              
              }
            }
          )
        },
        {
          title: "Lingettes",
          href: "/",
          render : () => renderRenderContent(
            {
              title: "Les Lingettes",
              description: "Nos lingettes sont fabriquées à partir de tissus de qualité, et sont disponibles en plusieurs coloris et motifs.",
              render: () => {
                return(
                  <div className='flex flex-wrap justify-center items-center'>
                    {Array(4).fill(0).map((_, index) => {
                      return(
                        <div key={index} className='w-10 h-10 bg-purple-400 m-2'>
                          <p>Item {index}</p>
                      </div>
                      )
                    })}
                  </div>
                )
              
              }
            }
          )
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
          title: "Stage",
          href: "/"
        },
        {
            title: "Cours",
            href: "/"
            },
            {
            title: "Atelier",
            href: "/"
            },
            {
            title: "Création",
            href: "/"
            },
            {
            title: "Réparation",
            href: "/"
            },
            {
            title: "Customisation",
            href: "/"
        }
      ]
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

  const renderRenderContent = ({title, description, render}: {title: string, description: string, render: () => JSX.Element}) => {
    return(
      <div className='flex flex-col'>
        <h1>{title}</h1>
        <p>{description}</p>
        <div>
          <h2>Les Promos</h2>
          {render()}
        </div>
        <div>
          <h2>Les Nouveautés</h2>
          {render()}
        </div>
        <div>
          <h2>Les Best Sellers</h2>
          <div className='flex flex-wrap justify-center items-center'>
            {render()}
          </div>
        </div>
      </div>
    )
  }