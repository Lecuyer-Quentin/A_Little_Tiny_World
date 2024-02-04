'use client'

import { signIn } from 'next-auth/react';
import { useForm } from 'react-hook-form'
import {zodResolver} from '@hookform/resolvers/zod'
import { LoginSchema, LoginSchemaType } from '@/model/Login';
import { useState, useEffect, useCallback, useTransition } from 'react';
import FormWrapper from '../../container/form';
import { Button } from '@/components/ui/button';
import GoogleAuthBtn from "@/app/components/button/authBtn/googleAuth";
import AppleAuthBtn from "@/app/components/button/authBtn/appleAuth";
import FacebookAuthBtn from "@/app/components/button/authBtn/facebookAuth";

import { IoMdEye } from "react-icons/io";
import { IoMdEyeOff } from "react-icons/io";



export default function RegisterForm() {
    const [isPending, startTransition] = useTransition()
    const [error, setError] = useState<string | null>(null)
    const [success, setSuccess] = useState<boolean>(false)
    const [isPasswordVisible, setIsPasswordVisible] = useState<boolean>(false)
    const [isConfirmPasswordVisible, setIsConfirmPasswordVisible] = useState<boolean>(false)
    const [isPasswordMatch, setIsPasswordMatch] = useState<boolean>(false)
    const [isPasswordMatchRegex, setIsPasswordMatchRegex] = useState<boolean>(false)

    const form = useForm({
        resolver: zodResolver(LoginSchema),
        defaultValues: {
            email: '',
            password: '',
            passwordConfirm: ''
        }
    })

    const regex = new RegExp(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/)

    const password = form.watch('password')
    const passwordConfirm = form.watch('passwordConfirm')

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

    const renderPasswordInput = () => {
        return (
            <div className="relative">
                <input
                    type={isPasswordVisible ? "text" : "password"}
                    placeholder="**********"
                    {...form.register('password')}
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
                    {...form.register('passwordConfirm')}
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


    const renderForm = () => {
        return(
            <form onSubmit={form.handleSubmit(handleSubmit)} className="flex flex-col gap-5 w-full">
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

                <Button 
                    type="submit"
                    className="w-full p-3 bg-black text-white rounded-lg hover:bg-black"
                >
                    {isPending 
                        ? 'Chargement...' 
                        : 'Inscription'
                        }
                </Button>

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
                <GoogleAuthBtn key={1}/>,
                <AppleAuthBtn key={2}/>,
                <FacebookAuthBtn key={3}/>
            ]}
            textContent="ou inscrivez-vous avec"
        >
            {renderForm()}
        </FormWrapper>
        )
    }



  return renderRegisterForm()
}
