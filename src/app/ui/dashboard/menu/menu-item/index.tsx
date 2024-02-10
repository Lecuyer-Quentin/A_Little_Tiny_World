
import RouterBtn from "@/app/components/button/routerBtn";

export default function MenuItem({subItem}: {subItem: {title: string, href: string, icon: React.ReactNode}}) {
    const {title, href, icon} = subItem;

    const renderMenuItem = () => {
        return (
            <li className="mt-1 relative group flex items-center px-2 py-2 cursor-pointer">
                <span className="absolute inset-y-0 left-0 w-1 bg-blue-400 rounded-tr-lg rounded-br-lg group-hover:bg-blue-600" aria-hidden="true" />
                <RouterBtn title={title} url={href} variant="ghost" icon={icon} className="w-full flex items-center justify-start gap-x-2" />
            </li>
        )
    }
    return renderMenuItem()
  }