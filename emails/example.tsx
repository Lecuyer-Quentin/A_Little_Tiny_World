import { Tailwind, Button } from "@react-email/components";

import * as React from "react";
type EmailTemplateProps = {
  firstName: string;
};

const Email: React.FC<Readonly<EmailTemplateProps>> = ({
  firstName,
}) => (
    <Tailwind
      config={{
        theme: {
          extend: {
            colors: {
              brand: "#007291",
            },
          },
        },
      }}
    >
      <h1>Welcome, {firstName}!</h1>
      <p className="text-gray-700">
        This is a sample email template using Tailwind CSS.
      </p>
      <Button
        href="https://example.com"
        className="bg-brand px-3 py-2 font-medium leading-4 text-white"
      >
        Click me
      </Button>
    </Tailwind>
  );

export default Email;
