import { Sheet, SheetContent, SheetDescription, SheetHeader, SheetTitle, SheetTrigger } from "@/components/ui/sheet"
import { MdOutlineDashboard, MdSchool, MdOutlineSecurity } from "react-icons/md";
import { FaUsers, FaIndustry, FaPercent } from "react-icons/fa";
import { RiListOrdered2 } from "react-icons/ri";
import { BsBank } from "react-icons/bs";
import { PiStudentBold } from "react-icons/pi";
import { IoIosSettings } from "react-icons/io";
import Menu from "@/app/ui/dashboard/menu";

export default function Sidebar() {

    const menuItems = [
        {
            title: "Tableau de Bord",
            list: [
                {
                    title: "Tableau de Bord",
                    href: "/dashboard",
                    icon: <MdOutlineDashboard />
                },
            ]
        },
        {
            title: "Gestion",
            list: [
                {
                    title: "Utilisateurs",
                    href: "/dashboard/users",
                    icon: <FaUsers />
                },
                {
                    title: "Produits",
                    href: "/dashboard/products",
                    icon: <FaIndustry />
                },
                {
                    title: "Stagiaires",
                    href: "/dashboard/students",
                    icon: <PiStudentBold />
                },
                {
                    title: "Cours",
                    href: "/dashboard/cours",
                    icon: <MdSchool />
                }
            ]
        },
        {
            title: "Ventes",
            list: [
                {
                    title: "Commandes",
                    href: "/dashboard/orders",
                    icon: <RiListOrdered2 />
                },
                {
                    title: "Factures",
                    href: "/dashboard/invoices",
                    icon: <BsBank />
                }
            ]
        },
        {
            title: "Marketing",
            list: [
                {
                    title: "Promotions",
                    href: "/dashboard/promotions",
                    icon: <FaPercent />
                },
            ]
        },
        {
            title: "Paramètres",
            list: [
                {
                    title: "Compte",
                    href: "/dashboard/account",
                    icon: <IoIosSettings />
                },
                {
                    title: "Sécurité",
                    href: "/dashboard/security",
                    icon: <MdOutlineSecurity />
                }
            ]
        }
    ]

    const renderSidebar = () => {
        return (
            <Sheet>
                <SheetTrigger>Open</SheetTrigger>
                    <SheetContent side={"left"} className="w-46">
                        <SheetHeader>
                            <SheetTitle>Tableau de Bord</SheetTitle>
                            <SheetDescription>
                                Administration de votre boutique
                              </SheetDescription>
                        </SheetHeader>

                        <Menu menuItems={menuItems} />

                </SheetContent>
            </Sheet>
        )
    }
  return renderSidebar()
}
