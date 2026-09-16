export type User = {
    name: string;
    email: string;
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};
