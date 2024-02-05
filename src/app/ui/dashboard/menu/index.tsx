import MenuItem from "./menu-item";

type MenuLinkProps = {
  menuItems: {
    title: string,
    list: {
      title: string,
      href: string,
      icon: React.ReactNode
    }[]
  }[]
};


export default function Menu({menuItems}: MenuLinkProps) {

  const renderMenu = () => {
    return menuItems.map((item) => {
        const {title, list} = item;
        return (
            <div key={title}>
                <h3 className="mt-8 text-xs font-semibold uppercase text-black">
                    {title}
                </h3>
                <ul className="mt-3">
                    {list.map((subItem) => (
                        <MenuItem subItem={subItem} key={subItem.title} />
                    ))}
                </ul>
            </div>
        )
    })
}   

  return renderMenu()
}
