
import { Button } from "@/components/ui/button"
import Image from 'next/image'
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table"
import RouterBtn from "@/app/components/button/routerBtn"

export default function Contact() {

    const renderContactForm = () => {
        return (
            <div className=' bg-slate-100 bg-opacity-50 p-5 flex flex-col justify-center items-center gap-5'>
                <h4 className='text-xl font-bold'>Contactez-nous</h4>
                <form className='flex flex-col justify-center items-center gap-5'>
                    <input type="text" placeholder="Nom" className='w-full p-2 rounded-md border-2 border-slate-300' />
                    <input type="email" placeholder="Email" className='w-full p-2 rounded-md border-2 border-slate-300' />
                    <textarea placeholder="Message" className='w-full p-2 rounded-md border-2 border-slate-300' />
                    <Button className='w-full' variant={'ghost'}>Envoyer</Button>
                </form>
            </div>
        )
    }

    const renderHeader = () => {
        const image = '/images/logo-hero.png'
        return (
            <div className='w-[90%] bg-slate-100 bg-opacity-50 p-5 gap-2 flex flex-col justify-center items-center text-xl text-center font-bold'>
                <h3>Retrouvez-nous à Aix-en-Provence</h3>
                <h2 >ou rejoignez l&apos;Aventure</h2>
                <Image src={image} alt="logo" width={200} height={200} />
                {renderSocialMedia()}
            </div>
        )
    }
    const renderGoggleMap = () => {
        const image = '/images/lavande.jpg'
        return (
            <div style={{backgroundImage: `url(${image})`,
            backgroundPosition: 'center',
            backgroundSize: 'cover',
             }}
            className="bg-black p-5 flex justify-center items-center rounded-lg">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2892.6297187993396!2d5.44805518063344!3d43.53091371336733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c98dbc6386718b%3A0x13485ce2ff25f013!2sAtelier%20Aix-en-Provence%20-%20A%20Little%20Tiny%20World%20Ltw!5e0!3m2!1sfr!2sfr!4v1707226945043!5m2!1sfr!2sfr" 
                width="400" height="250"  loading="lazy" className="rounded-lg" />
            </div>
        )
    }
 
    //todo : add a mailto link
    const renderAdresse = () => {
        const mailto = "mailto:alittletinyworld13@gmail.com?subject=Demande%20de%20projet%20de%20développement%20web&body=Bonjour%20,%0A%0AJe%20suis%20intéressé(e)%20par%20une%20collaboration%20sur%20un%20projet%20de%20développement%20web.%20Voici%20quelques%20informations%20initiales%20:%0A%0A-%20Nom%20:%20[Votre%20Nom]%0A-%20Entreprise%20:%20[Le%20nom%20de%20votre%20entreprise%20ou%20organisation]%0A-%20Site%20web%20:%20[Facultatif%20-%20Votre%20site%20web%20actuel]%0A-%20Description%20du%20projet%20:%20[Brève%20description%20du%20projet]%0A%0AMerci%20et%20j'attends%20votre%20retour%20avec%20impatience."

        return (
            <div className='w-[90%] bg-slate-100 bg-opacity-50 p-5 flex flex-col justify-between items-center gap-10
                            md:flex md:flex-row md:justify-center md:items-center'>
                {renderGoggleMap()}

                <div className='flex flex-col justify-center items-center
                                md:flex md:justify-center md:items-start'>
                    <h4 className='text-xl font-bold'>L&apos;Atelier</h4>
                    <p className="text-center md:text-left">7 rue du Puits Neuf<br /> 13090 Aix-en-Provence</p>
                    <a href="tel:+33442212465" className='hover:text-blue-400'>04 42 21 24 65</a>
                    <a href={mailto}  className='hover:text-blue-400' target="_blank" rel="noreferrer">
                        alittletinyworld13@gmail.com
                    </a>
                </div>
            </div>
        )
    }
    const renderSocialMedia = () => {
        const socialMedia = [
            {
                name: 'facebook',
                link: 'https://www.facebook.com/alittletinyworld13',
                image: '/images/facebook.png'
            },
            {
                name: 'instagram',
                link: 'https://www.instagram.com/alittletinyworld13/',
                image: '/images/instagram.png'
            }
        ]

        return (
            <div className='flex flex-row justify-center items-center'>
                {socialMedia.map((media, index) => (
                    <RouterBtn key={index} url={media.link} asChild={true} className='mx-2'
                                 title={media.name} image={media.image}>
                    </RouterBtn>
                ))}

            </div>
        )
    }
    const renderHoraireTable = () => {
        return (
            <div>
            <Table className='flex flex-col justify-center items-center bg-slate-100 bg-opacity-50 p-5 rounded-lg'>
            <TableCaption className="text-center font-bold text-2xl text-black p-5"
            >Horaire d&apos;ouverture</TableCaption>
            <TableHeader>
              <TableRow >
                <TableHead className="text-xl text-black">En période scolaire</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody className="font-bold text-lg">
              <TableRow>
                <TableCell >
                    Mercredi - Vendredi - Samedi
                </TableCell>
                <TableCell className="text-right">10h-17h</TableCell>
              </TableRow>
                <TableRow>
                    <TableCell>
                        Mardi - Jeudi
                    </TableCell>
                    <TableCell className="text-right">
                        Rendez-vous professionnels <br/>
                        Confection sur mesure
                    </TableCell>
                </TableRow>
                <TableRow>
                    <TableCell>
                        Dimanche - Lundi
                    </TableCell>
                    <TableCell className="text-right">Fermé</TableCell>
                </TableRow>
            </TableBody>
          </Table>
          </div>
        )
    }

    const renderContact = () => {
        return (
            <section className='w-full h-auto flex flex-col relative justify-center items-center gap-10'>
                {renderContactForm()}
                {renderHeader()}
                {renderAdresse()}
                {renderHoraireTable()}
            </section>
        )
    }

  return renderContact()
}