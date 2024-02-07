import Sidebar from "@/app/ui/dashboard/sidebar";
import type { Metadata } from "next";


export const metadata: Metadata = {
    title: "Panneau de contrôle",
    description: "Panneau de contrôle"
};


export default function DashboardLayout({
    children,
}: {
    children: React.ReactNode
}) {
    return (
        <main>
            <Sidebar />
            {children}
        </main>
    )
}