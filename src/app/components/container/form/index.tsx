import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"

interface FormWrapperProps {
    children: React.ReactNode,
    title: string,
    description: string,
    social?: React.ReactNode[],
    textContent?: string

}

export default function FormWrapper({children, title, description, social, textContent}: FormWrapperProps) {


    const renderFormWrapper = () => {
        return (
            <Card className="flex flex-col items-center text-center">
                <CardHeader>
                    <CardTitle className="text-[1.4rem] font-bold">
                        {title}
                    </CardTitle>
                    <CardDescription>
                        {description}
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    {children}
                </CardContent>
                <CardFooter className="flex flex-col items-center gap-3">
                    <CardDescription>
                        {textContent}
                    </CardDescription>
                    <div className="flex gap-5">
                        {social}
                    </div>
                </CardFooter>
            </Card>
        )
    }

    return renderFormWrapper()
}