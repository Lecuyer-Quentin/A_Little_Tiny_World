import * as z from 'zod';


export const LoginSchema = z.object({
  email: z.string().email({
    message: 'Invalid email address',
  }),
  password: z.string().min(6, {
    message: 'Password must be at least 6 characters',
    }).max(100, {
        message: 'Password must be less than 100 characters',
    })
    //).regex(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/, {
    //    message: 'Password must contain at least one uppercase letter, one lowercase letter, and one number',
    //}
    //),
});

export type LoginSchemaType = z.infer<typeof LoginSchema>;