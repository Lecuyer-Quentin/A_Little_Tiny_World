import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./ui/globals.css"
import Header from "./ui/layout/header";
import { Providers } from "./context/providers";
import Footer from "./ui/layout/footer";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "A Little Tiny World ",
  description: "",
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="fr">
      <body className={inter.className + ''}>
        <Providers>
          <Header />
          <main className=' flex flex-col justify-between items-center min-h-screen gap-y-6 pt-32 md:pt-28'>
            {children}
          </main>
          <Footer />
        </Providers>
      </body>
    </html>
  )
}
