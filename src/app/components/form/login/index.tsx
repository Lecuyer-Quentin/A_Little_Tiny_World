'use client'

import { useForm } from 'react-hook-form'
import { signIn } from 'next-auth/react'
import {zodResolver} from '@hookform/resolvers/zod'
import { useTransition } from "react";
import { LoginSchema, LoginSchemaType } from '@/model/Login';
import { useState } from 'react';
import FormWrapper from '../../container/form';
import { Button } from '@/components/ui/button';
import GoogleAuthBtn from "@/app/components/button/authBtn/googleAuth";
import AppleAuthBtn from "@/app/components/button/authBtn/appleAuth";
import FacebookAuthBtn from "@/app/components/button/authBtn/facebookAuth";


export default function LoginForm() {
    const [isPending, startTransition] = useTransition()
    const [error, setError] = useState<string | null>(null)
    const [success, setSuccess] = useState<boolean>(false)

    const form = useForm({
        resolver: zodResolver(LoginSchema),
        defaultValues: {
            email: '',
            password: ''
        }
    })

    const handleSubmit = async () => {
        const data = form.getValues()
        const {email, password} = data as LoginSchemaType
        setError(null)
        startTransition(() => {
            signIn('credentials', {
                email,
                password,
                redirect: false
            }).then((res) => {
                if(res?.error) {
                    setError(res.error)
                } else {
                    setSuccess(true)
                }
            })
        })
    }

    const renderForm = () => {
        return(
            <form onSubmit={form.handleSubmit(handleSubmit)} className="flex flex-col gap-5 w-full">
                <input
                    type="email"
                    placeholder="Email"
                    {...form.register('email')}
                    className="w-full p-3 border-2 border-gray-300 rounded-lg"
                />
                <input
                    type="password"
                    placeholder="**********"
                    {...form.register('password')}
                    className="w-full p-3 border-2 border-gray-300 rounded-lg text-black"
                />
                <Button type="submit" className="w-full p-3 bg-black text-white rounded-lg ">
                    {isPending ? 'Chargement...' : 'Connexion'}
                </Button>

                {error && <p className="text-red-500">{error}</p>}
                {success && <p className="text-green-500">Success</p>}
            </form>
        )
    }

    const renderLoginForm = () => {
        return (
            <FormWrapper
                title="Ravie de vous revoir"
                description="Connectez-vous pour accéder à votre compte"
                textContent="ou connectez-vous avec"
                social={[
                    <GoogleAuthBtn key={1}/>,
                    <AppleAuthBtn key={2}/>,
                    <FacebookAuthBtn key={3} />
                ]}
            >
                {renderForm()}
            </FormWrapper>
        )
    }




    return renderLoginForm()
}

