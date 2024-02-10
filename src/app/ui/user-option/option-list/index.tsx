
import RouterBtn from "@/app/components/button/routerBtn";

const menuItems = [
    {
        title: "Ma Liste de souhaits",
        href: "/wishlist",
    },
    {
        title: "Mes Commandes",
        href: "/orders",
    },
    {
        title: "Mes Factures",
        href: "/invoices",
    },
    {
        title: "Mon Profil",
        href: "/profile",
    },
    {
        title: "Paramètres",
        href: "/settings",
    },
    {
        title: "Dashboard",
        href: "/dashboard",
    },
]

type OptionListProps = {
    role: string | null | undefined;
}

export default function OptionList({role}: OptionListProps) {

    const renderMenu = () => {
        if (role === "admin" || role === "dev") {
            return renderAdminMenu()
        }
        return renderUserMenu()
    }

    const renderUserMenu = () => {
        const menuItemsUser = menuItems.filter((item) => item.title !== "Dashboard")
        return (
            <ul className="mt-4 space-y-1">
                {menuItemsUser.map((item) => renderMenuItem(item))}
            </ul>
        )
    }

    const renderAdminMenu = () => {
        const menuItemsAdmin = menuItems
        return (
            <ul className="mt-4 space-y-1">
                {menuItemsAdmin.map((item) => renderMenuItem(item))}
            </ul>
        )
    }

    const renderMenuItem = (item: {title: string, href: string}) => {
        return (
            <li key={item.title} className="mt-1 relative group">
                <span className="absolute inset-y-0 left-0 w-1 bg-gray-400 rounded-tr-lg rounded-br-lg group-hover:bg-blue-600" aria-hidden="true" />
                <RouterBtn url={item.href} title={item.title} variant="ghost" className="w-full flex justify-start text-black py-2 text-sm font-medium gap-4 group:hover:bg-blue-100 group-hover:text-blue-600" />
            </li>
        )
    }
  return renderMenu()
}
