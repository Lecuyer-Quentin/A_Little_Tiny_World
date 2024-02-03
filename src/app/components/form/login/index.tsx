'use client'

import { useForm } from 'react-hook-form'
import { signIn } from 'next-auth/react'
import {zodResolver} from '@hookform/resolvers/zod'
import { useTransition } from "react";
import { LoginSchema, LoginSchemaType } from '@/model/Login';
import { useState } from 'react';


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


    return (
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
            <button
                type="submit"
                className="w-full p-3 bg-black text-white rounded-lg"
            >
                {isPending ? 'Loading...' : 'Login'}
            </button>
            {error && <p className="text-red-500">{error}</p>}
            {success && <p className="text-green-500">Success</p>}
        </form>
    )





}

