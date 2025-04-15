export const getTypeGradientStyle = (types: string[]): React.CSSProperties => {
    const typeColors: Record<string, string> = {
        fire: "#F97316",
        grass: "#22C55E",
        water: "#3B82F6",
        electric: "#FACC15",
        psychic: "#EC4899",
        ice: "#06B6D4",
        dragon: "#8B5CF6",
        dark: "#374151",
        fairy: "#F9A8D4",
        normal: "#9CA3AF",
        fighting: "#DC2626",
        flying: "#6366F1",
        poison: "#9333EA",
        ground: "#CA8A04",
        rock: "#6B7280",
        bug: "#16A34A",
        ghost: "#4C1D95",
        steel: "#71717A",
        default: "#E5E7EB",
    };

    const typePrimary = types[0].toLowerCase();

    const from = typeColors[typePrimary] || typeColors.default;

    // Uncomment this if you want to use a second type for the gradient
    // const typeSecondary = types[1] ? types[1].toLowerCase() : 'default';
    // const to = typeColors[typeSecondary] || typeColors.default;

    return {
        background: `linear-gradient(to bottom right, ${from}, #E5E7EB)`,
    };
};