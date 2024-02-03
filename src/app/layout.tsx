import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./ui/globals.css"
import Header from "./ui/layout/header";
import { Providers } from "./context/providers";

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
            {children}
        </Providers>
      </body>
    </html>
  )
}
