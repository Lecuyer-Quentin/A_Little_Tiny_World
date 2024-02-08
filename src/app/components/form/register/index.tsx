'use client'

import { signIn } from 'next-auth/react';
import { useForm } from 'react-hook-form'
import {zodResolver} from '@hookform/resolvers/zod'
import { LoginSchema, LoginSchemaType } from '@/model/login';
import { useState, useEffect, useCallback, useMemo } from 'react';
import FormWrapper from '../../container/form';
import { Button } from '@/components/ui/button';
import { IoMdEye } from "react-icons/io";
import { IoMdEyeOff } from "react-icons/io";
import { AiOutlineLoading3Quarters } from "react-icons/ai";
import AuthBth from '../../button/authBtn';
import { FcGoogle } from "react-icons/fc";
import { FaFacebook } from "react-icons/fa";





export default function RegisterForm() {
    const [error, setError] = useState<string | null>(null)
    const [success, setSuccess] = useState<boolean>(false)
    const [isPasswordVisible, setIsPasswordVisible] = useState<boolean>(false)
    const [isConfirmPasswordVisible, setIsConfirmPasswordVisible] = useState<boolean>(false)
    const [isPasswordMatch, setIsPasswordMatch] = useState<boolean>(false)
    const [isPasswordMatchRegex, setIsPasswordMatchRegex] = useState<boolean>(false)
    const [passwordConfirm, setPasswordConfirm] = useState<string>('')
    const [isLoading, setIsLoading] = useState<boolean>(false)

    const form = useForm({
        resolver: zodResolver(LoginSchema),
        defaultValues: {
            email: '',
            password: '',
            //passwordConfirm: ''
        }
    })

    const regex = useMemo(() => {
        return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/
    }
    , [])

    const canSubmit = () => form.formState.isValid && isPasswordMatch && isPasswordMatchRegex
    const password = form.watch('password')

    const handlePasswordVisibility = () => {
        setIsPasswordVisible(!isPasswordVisible)
    }

    const handleConfirmPasswordVisibility = () => {
        setIsConfirmPasswordVisible(!isConfirmPasswordVisible)
    }

    const checkPasswordMatchRegex = useCallback(() => {
        if(regex.test(password)) {
            setIsPasswordMatchRegex(true)
        } else {
            setIsPasswordMatchRegex(false)
        }
    }
    , [password, regex])

    const checkPasswordMatch = useCallback(() => {
        if(password === passwordConfirm) {
            setIsPasswordMatch(true)
        } else {
            setIsPasswordMatch(false)
        }
    }
    , [password, passwordConfirm])


    useEffect(() => {
        checkPasswordMatchRegex()
        checkPasswordMatch()
    }), [checkPasswordMatch, checkPasswordMatchRegex]


    const handleSubmit = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault()
        const data = form.getValues()
        const { email, password } = data as LoginSchemaType
        setError(null)
        setSuccess(false)
        setIsLoading(true)
        try{
            const res = await fetch('/api/auth/sign-up', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email, password })
            })
            await res.json()
        } catch (error) {
            setError('Une erreur est survenue')
        }
        try{
            signIn('credentials', {
                email,
                password,
                callbackUrl: '/'
            })
        } catch (error) {
            setError('Une erreur est survenue sign in')
        }
    }

    const renderPasswordInput = () => {
        return (
            <div className="relative">
                <input
                    type={isPasswordVisible ? "text" : "password"}
                    placeholder="**********"
                    onChange={(e) => setPasswordConfirm(e.target.value)}
                    className="w-full p-3 border-2 border-gray-300 rounded-lg"
                />
                <button
                    type="button"
                    onClick={handlePasswordVisibility}
                    className="absolute right-3 top-3"
                >
                    {isPasswordVisible 
                        ? <IoMdEyeOff size={20} />
                        : <IoMdEye size={20} />
                    }
                </button>
            </div>
        )
    }

    const renderConfirmPasswordInput = () => {
        return (
            <div className="relative">
                <input
                    type={isConfirmPasswordVisible ? "text" : "password"}
                    placeholder="**********"
                    {...form.register('password')}
                    className="w-full p-3 border-2 border-gray-300 rounded-lg"
                />
                <button
                    type="button"
                    onClick={handleConfirmPasswordVisibility}
                    className="absolute right-3 top-3"
                >
                    {isConfirmPasswordVisible 
                        ? <IoMdEyeOff size={20} />
                        : <IoMdEye size={20} />
                    }
                </button>
            </div>
        )
    }

    const renderPasswordConfirmation = () => {
        return (
            <>
                {!isPasswordMatch && password.length > 0 && passwordConfirm.length > 0
                    ? <p className="text-red-500 text-xs">
                        Les mots de passe ne correspondent pas
                    </p>
                    : null
                }
            </>
        )
    }

    const renderRegexPassword = () => {
        return(
            <>
                {!isPasswordMatchRegex && password.length > 0 && passwordConfirm.length > 0
                    ? <p className="text-red-500 text-xs">
                        Le mot de passe doit contenir au moins 8 caractères, une lettre et un chiffre
                    </p>
                    : null
                }
            </>
        )
    }


    const renderInscriptionBtn = () => {
        return (
            isLoading ?
                <Button disabled>
                    <AiOutlineLoading3Quarters className="mx-2 h-4 w-4 animate-spin" />
                    Please wait
                </Button>
            :
            canSubmit() && 
                <Button 
                    type="submit"
                    className="w-full p-3 bg-black text-white rounded-lg hover:bg-black"
                >
                    Inscription
                </Button>
        )
    }

    const renderForm = () => {
        return(
            <form onSubmit={handleSubmit}
                    className="flex flex-col gap-5 w-full">
                <input
                    type="email"
                    placeholder="Email"
                    {...form.register('email')}
                    className="w-full p-3 border-2 border-gray-300 rounded-lg"
                />
                {renderPasswordInput()}
                {renderConfirmPasswordInput()}
                {renderPasswordConfirmation()}
                {renderRegexPassword()}

                {renderInscriptionBtn()}

                {error && <p className="text-red-500">{error}</p>}
                {success && <p className="text-green-500">Success</p>}
            </form>
        )
    }

    const renderRegisterForm = () => {
        return (
        <FormWrapper
            title="Bienvenue dans l'aventure"
            description="Inscrivez-vous pour accéder à toutes les fonctionnalités de l'application"
            social={[
                <AuthBth key={1} provider="google" icon={<FcGoogle className="h-5 w-5" />} />,
                <AuthBth key={2} provider="facebook" icon={<FaFacebook className="h-5 w-5" />} />
            ]}
            textContent="ou inscrivez-vous avec"
        >
            {renderForm()}
        </FormWrapper>
        )
    }

  return renderRegisterForm()
}
