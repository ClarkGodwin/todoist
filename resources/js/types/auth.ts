export type User = {
    name: string;
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};
